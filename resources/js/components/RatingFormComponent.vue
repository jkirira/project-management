<template>
    <div id="my-modal" class="modal" v-show="show" @click="outside_click">

        <div class="modal-content">
            <div class="modal-header flex items-center justify-between">
                <span class="close" @click="$emit('closeModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="container px-5 pt-24 pb-16 mx-auto">

                    <div class="flex items-center justify-center px-2 w-3/4 mx-auto rounded-md mb-12 border-2 border-red-500" v-show="error">
                        <h1 class="sm:text-2xl text-xl font-medium title-font text-red-500">{{error}}</h1>
                    </div>

                    <h1 class="text-2xl font-medium title-font text-gray-900 mb-6">Rating</h1>

                    <div class="px-4 mx-2">
                        <star-rating v-model="rating_value" :increment="0.5" :border-width="3" :padding="10" ></star-rating>
                    </div>

                    <div class="flex flex-col border-b border-green-500 py-2 mt-16 my-8">
                        <label for="rating-comment" class="leading-7 text-md my-5">Comment on your experience</label>
                        <input v-model="rating_comment" id="rating-comment" class="appearance-none bg-transparent border-none w-full h-16 text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Leave a comment" aria-label="Full name">
                    </div>

                    <button @click="saveRating" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                        Rate
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import base_url from "../baseUrl";
import StarRating from 'vue-star-rating';

export default {
    name: "RatingFormComponent",
    props: ['show_modal', 'issue_id'],
    components: {
        StarRating
    },
    data(){
        return {
            show: false,
            error: '',
            rating_value: 0,
            rating_comment: ''
        }
    },
    watch: {
        show_modal: function () {
            this.show = this.show_modal;
        }
    },
    methods:{
        outside_click(e) {
            let outsideModal = document.getElementById('my-modal')
            if (e.target == outsideModal){
                this.$emit('closeModal')
            }
        },

        saveRating(){

            if( !this.rating_value ) {
                this.error = "Please choose a rating by clicking on the stars"
                return
            }

            axios({
                method: 'post',
                url: base_url + '/api/issues/' + this.issue_id + '/rate',
                data: {'comment': this.rating_comment, 'value': this.rating_value },
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('token')
                }
            }).then((response) => {
                console.log(response.data)
                this.$swal('Success', response.data['message']);
                this.rating = response.data['issue'].value;
                window.location = base_url + '/issue/' + this.issue_id;
                return
            }) .catch((err) => {
                this.error = "There was an error processing your request"
                console.log(err)
                // window.location = base_url + '/issue/' + this.issue_id;
                return
            })
        }

    }

}

</script>

<style>

.modal {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    margin: auto;
    min-width: 45%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    background: #fff;
    min-height: 300px;
}

.modal-header h2,
.modal-footer h3 {
    margin: 0;
}

.modal-header {
    position: absolute;
    right: 0;
    top: 0;
    padding: 15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.modal-body {
    padding: 10px 20px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

/*.modal-footer {*/
/*    background: #cccccc;*/
/*    padding: 10px;*/
/*    color: #fff;*/
/*    text-align: center;*/
/*    border-bottom-left-radius: 5px;*/
/*    border-bottom-right-radius: 5px;*/
/*}*/

.close {
    /*color: #ccc;*/
    float: right;
    font-size: 30px;
    padding: 5px 20px;
}

.close:hover,
.close:focus {
    color: #fff;
    background: #ccc;
    text-decoration: none;
    cursor: pointer;
}



</style>
