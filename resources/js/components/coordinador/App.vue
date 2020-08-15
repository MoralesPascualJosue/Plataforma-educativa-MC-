<template>
    <div>
        <h1>PDEPI</h1>

        <p>
            <router-link :to="{ name: 'Inicio' }">Inicio</router-link>
            | <router-link :to="{ name: 'Avisos' }">Avisos</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {};
</script>
