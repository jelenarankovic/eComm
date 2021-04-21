<template>
    <div style="padding: 1.25rem" class="d-none d-md-block">
        <h6 class="text-uppercase text-secondary font-weight-bolder pt-4">Review list:</h6>       

        <div v-if="loading">Loading...</div>
        <div v-else>
            <div class="border-bottom" v-for="(review, index) in reviews" :key="index">
                <div class="row pt-3">
                    <div class="col-md-6">Jovan Popovic</div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <star-rating :value="review.rating" class="fa-lg"></star-rating>    <!--napravi da se pojavi rucica kada se predje preko zvezda --> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-secondary">{{ review.created_at | fromNow}}</div>
                </div>
                <div class="row pt-3 pb-2">
                    <div class="col-md-12">{{ review.content }}</div>
                </div>
            </div>
        </div> 
    </div> 
</template>

<script>
//import moment from "moment";
export default {
    props: {
        bookableId: String
    },
    data() {
        return {
            loading: false,
            reviews: null
        };
    },
    created() {
        this.loading = true;
        axios
            .get(`/api/bookables/${this.bookableId}/reviews`)
            .then(response => (this.reviews = response.data.data))
            .then(() => (this.loading = false));
    }
 //   filters:{
 //       fromNow(value){
 //          return moment(value).fromNow();
 //       }
 //   }
};
</script>