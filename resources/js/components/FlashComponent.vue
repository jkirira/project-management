<template>
    <div id="my-modal" class="modal" v-show="show">

        <div class="modal-content">
            <div class="modal-header flex items-center justify-between">
                <h2 class="mx-4">' {{show.name}} ' movie Trailer</h2>
                <span class="close" @click="closeModal">&times;</span>
            </div>
            <div class="modal-body">

                {{ body }}

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['message'],
    data(){
        return {
            body: '',
            show: true
        }
    },
    created(){
        if(this.message) {
            this.openModal(this.message)
        }

        window.addEventListener('flash', (message) => {
             this.openModal(message);
        });


        window.addEventListener('click', (e) => {
            const modal = document.querySelector('#my-modal');
            if (e.target == modal) {
                this.show = false;
            }
        });

    },
    methods:{

        openModal(message) {
            this.body = message;
            this.show = true;
        },

        closeModal() {
            this.show = false;
        },

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
    margin: auto;
    width: 60%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    background: #fff;
    min-height: 500px;
}

.modal-header h2,
.modal-footer h3 {
    margin: 0;
}

.modal-header {
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

.modal-footer {
    background: #cccccc;
    padding: 10px;
    color: #fff;
    text-align: center;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

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
