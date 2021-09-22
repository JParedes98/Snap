<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <b-jumbotron header="Welcome to Snap App" bg-variant="info" text-variant="white" class="text-center">
                    <h5>We are happy to see you around, hope that you enjoy Snap Managment Tool. Here you can manage your PDF Files, Snippets and Links. </h5>
                    <hr>
                    <h4>Let's create/store a new:</h4>
                    <br>
                    <b-button :to="{ name: 'files' }" size="lg" pill variant="light">
                        <i class="far fa-file-alt"></i>&nbsp;File
                    </b-button>
                    <b-button :to="{ name: 'snippets' }" size="lg" pill variant="light" href="#">
                        <i class="fas fa-code"></i>&nbsp;Snippet
                    </b-button>
                    <b-button :to="{ name: 'links' }" size="lg" pill variant="light" href="#">
                        <i class="fas fa-link"></i>&nbsp;Link
                    </b-button>
                </b-jumbotron>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-blue custom-card">
                    <div class="card-block">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-block">
                                <h6 class="m-b-20">Files Stored</h6>
                                <b-link :to="{ name: 'files' }" class="m-b-0 text-white">
                                    View All&nbsp;<i class="fas fa-chevron-right"></i>
                                </b-link>
                            </div>

                            <h2 class="text-right">
                                <i class="far fa-file-alt float-left"></i>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-green custom-card">
                    <div class="card-block">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-block">
                                <h6 class="m-b-20">Snippets Stored</h6>
                                <b-link :to="{ name: 'snippets' }" class="m-b-0 text-white">
                                    View All&nbsp;<i class="fas fa-chevron-right"></i>
                                </b-link>
                            </div>

                            <h2 class="text-right">
                                <i class="fas fa-code float-left"></i>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-yellow custom-card">
                    <div class="card-block">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-block">
                                <h6 class="m-b-20">Links Stored</h6>
                                <b-link :to="{ name: 'snippets' }" class="m-b-0 text-white">
                                    View All&nbsp;<i class="fas fa-chevron-right"></i>
                                </b-link>
                            </div>

                            <h2 class="text-right">
                                <i class="fas fa-link float-left"></i>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Welcome"
}
</script>

<style scoped>
.custom-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

/*.custom-card i {*/
/*    font-size: 26px;*/
/*}*/
</style>
