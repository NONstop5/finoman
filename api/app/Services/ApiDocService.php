<?php

declare(strict_types=1);

namespace App\Services;

use Closure;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionException;

class ApiDocService
{
    /** @var Router */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Возвращает список роутов
     *
     * @param string $prefix
     *
     * @return Collection
     */
    public function getRoutes(string $prefix = 'api'): Collection
    {
        $routeList = $this->router->getRoutes();

        if ($prefix) {
            $routeList = collect($routeList)->filter(
                function (Route $route) use ($prefix) {
                    return $route->getPrefix() === $prefix;
                }
            );
        }

        // usort(
        //     $routeList,
        //     function (Route $route1, Route $route2) {
        //         return strnatcmp($route1->action['groupName'] ?? 'unnamed', $route2->action['groupName'] ?? 'unnamed');
        //     }
        // );

        return $routeList->sort(
            function (Route $route) {
                return $route->getAction('groupName');
            }
        );
    }

    /**
     * Возвращает список правил валидации класса Request
     *
     * @param FormRequest $requestClass
     * @param array $requestMethods
     *
     * @return mixed
     */
    public function getRequestClassRules(FormRequest $requestClass, array $requestMethods)
    {
        $rules = [];

        foreach ($requestMethods as $requestMethod) {
            $requestClass->setMethod($requestMethod);
            $requestRules = $requestClass->rules() ?? [];
            $requestAttributes = $requestClass->attributes() ?? [];

            $rules[$requestMethod] = array_map(
                function ($fieldName, $fieldRules) use ($requestAttributes) {
                    if (is_string($fieldRules)) {
                        $fieldRules = explode('|', $fieldRules);
                    }

                    return [
                        'field' => $fieldName,
                        'description' => $requestAttributes[$fieldName] ?? '',
                        'rules' => $fieldRules,
                    ];
                },
                array_keys($requestRules),
                $requestRules
            );
        }

        return $rules;
    }

    /**
     * Возвращает список правил валидации для роута
     *
     * @param Route $route
     *
     * @return array|mixed
     * @throws ReflectionException
     */
    public function getRouteRules(Route $route)
    {
        $emptyRules = collect($route->methods())->mapWithKeys(
            function ($method) {
                return [$method => []];
            }
        )->toArray();

        if ($route->getAction('uses') instanceof Closure) {
            return $emptyRules;
        }

        $reflection = new ReflectionClass($route->getController());

        $controllerActionMethodName = $route->getActionMethod();

        $reflectionMethod = $reflection->getMethod($controllerActionMethodName);
        $reflectionParameters = $reflectionMethod->getParameters();

        foreach ($reflectionParameters as $parameter) {
            try {
                $parameterType = $parameter->getClass();
                $className = $parameterType->name;

                if ($parameterType !== null && class_exists($className)) {
                    if (is_subclass_of($className, FormRequest::class)) {
                        $requestClass = new $className();

                        return $this->getRequestClassRules($requestClass, $route->methods());
                    }
                }
            } catch (Exception $e) {
                return $emptyRules;
            }
        }

        return $emptyRules;
    }

    /**
     * Возвращает данные для документации Api
     *
     * @param Collection $routes
     *
     * @return array
     */
    public function getApiDocData(Collection $routes): array
    {
        return $routes->mapToGroups(
            function (Route $route) {
                $groupName = $route->getAction('groupName') ?? 'unnamed';

                return [
                    $groupName => [
                        'uri' => $route->uri(),
                        'methods' => $route->methods(),
                        'request' => $this->getRouteRules($route),
                    ],
                ];
            }
        )->toArray();
    }
}
