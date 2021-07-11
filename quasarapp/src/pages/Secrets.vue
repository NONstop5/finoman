<template>
  <q-page padding>
    <div>
      <div v-if="secrets.length" class="row">
        <div class="secret" v-for="(secret, index) in secrets" :key="index">
          <strong v-text="secret.secret"></strong> - created at <span v-text="secret.created_at"></span>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  // name: 'PageName',
}
</script>
