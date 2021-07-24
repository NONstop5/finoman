<template>
  <q-page padding>
    <div>
      <div
        v-if="secrets.length"
        class="row"
      >
        <div
          v-for="(secret, index) in secrets"
          :key="index"
          class="secret"
        >
          <strong v-text="secret.secret" /> - created at <span v-text="secret.created_at" />
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  // name: 'PageName',
};
</script>
