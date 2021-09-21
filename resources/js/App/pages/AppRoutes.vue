<template>
<div>
    <navbar></navbar>

    <div class="py-4">
        <router-view></router-view>
    </div>
</div>
</template>


<script>
import Navbar from '../components/Navbar';

export default {
    components: {
        navbar: Navbar,
    },
}
</script>
