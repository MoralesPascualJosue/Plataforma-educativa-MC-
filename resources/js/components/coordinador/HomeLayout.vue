<template>
    <div class="row">
        <div
            class="banner"
            style="background-image: url('../resources/welcome1.jpg');"
        >
            <h2 class="banner-tittle">
                <span class="banner-ttitle-text">
                    Maestria en contruccion
                </span>
            </h2>
        </div>

        <div class="">
            <h3 class="subheader-tittle">
                Mision maestria en construccion
            </h3>
            <div class="content-mensaje">
                <div class="content-img-mision">
                    <img
                        alt="Mision imagen"
                        class="img-decoration"
                        :src="image"
                    />
                </div>

                <span class="mensaje-texto">
                    Formar recursos humanos de alto nivel profesional que logren
                    proponer soluciones adecuadas y favorables a las necesidades
                    que demanda la construcción de obras de infraestructura para
                    el bienestar de nuestro Estado.
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            image: "../resources/img-msg100.jpg"
        };
    }
};
</script>

<style>
.img-decoration {
    width: 100%;
}

.banner {
    background-size: cover;
    padding-top: 0;
    width: 100%;
    height: 10rem;
}

.banner-tittle {
    padding-top: 8%;
    padding-left: 74%;
}

.banner-ttitle-text {
    color: #fff;
}
</style>
