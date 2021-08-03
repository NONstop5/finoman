<template>
    <wallets-list v-if="store.user.state.wallets.length"/>
    <nothing-here v-else icon="la la-wallet" label="no wallets yet"/>
</template>