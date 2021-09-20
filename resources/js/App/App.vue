<template>
    <div>
        <div class="loader-overlay" v-show="loader_is_active">
            <div class="loader">
                <b-spinner style="width: 3rem; height: 3rem;" type="grow" variant="primary"></b-spinner>
                <h4 class="text-muted font-weight-bold mt-3">LOADING</h4>
            </div>
        </div>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    computed: {
        loader_is_active() {
            return this.$store.getters.loader_is_active;
        },
    },
}
</script>


<style lang="scss" scoped>
.loader-overlay {
    background: rgba($color: #ffffff, $alpha: 0.95);
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999999999999999999;

    animation: fadeIn 0.5s;
    -webkit-animation: fadeIn 0.5s;
    -moz-animation: fadeIn 0.5s;
    -o-animation: fadeIn 0.5s;
    -ms-animation: fadeIn 0.5s;

.loader {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
}
</style>
