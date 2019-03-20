<template>
    <div>
        <div class="row portfolio">
            <div v-for="(item, i) in result.medias" :key="i" class="col-sm-4 portfolio-item animation-fadeInQuick">
                <div class="thumb-wrap">
                    <a :href="$helper.post_route(item)">
                        <img :src="item.imageThumbnailUrl" :alt="item.shortCode" class="img-responsive">
                    </a>
                    <span class="portfolio-item-info" v-html="$helper.caption_decode(item.caption)"></span>
                    <span class="portfolio-item-icon">
                        <i class="fa fa-2x"></i>
                    </span>
                </div>
                <div><i>{{ item.createdTime | moment("from", "now") }}..</i></div>
                <div class="row text-center animation-fadeIn">
                    <div class="col-xs-6">
                        <h3 class="h5"><i class="fa fa-heart-o text-danger"></i> <span>{{ $helper.numberToString(item.likesCount) }}</span></h3>
                    </div>
                    <div class="col-xs-6">
                        <h3 class="h5"><i class="fa fa-comment-o text-success"></i> <span>{{ $helper.numberToString(item.commentsCount) }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-wrap text-center">
            <i class="fa fa-spinner fa-2x text-success fa-spin" v-if="loading"></i>
            <button v-else class="btn btn-default more-item-icon" @click="load()">
                MORE
                <br>
                <i class="fa fa-angle-double-down fa-2x"></i>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['info'],
        data(){
            return {
                result: {
                    medias: [],
                    hasNextPage: true,
                    maxId: this.info.maxId
                },
                loading: false,
            }
        },
        mounted() {
        },
        methods: {
            load(){
                this.loading = true;
                axios.get(this.info.url+'&maxId='+this.result.maxId).then( (response) => {
                    response.data.medias = this.result.medias.concat(response.data.medias);
                    this.result = response.data;
                }).catch( (error) => {
                    console.log(error)
                }).then(() => {
                    this.loading = false;
                });
            }
        },
    }
</script>
