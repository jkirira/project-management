<template>
    <div id="my-modal" class="modal" v-show="show" @click="outside_click">

        <div class="modal-content">
            <div class="modal-header flex items-center justify-between">
                <span class="close" @click="$emit('closeModal')">&times;</span>
            </div>
            <div class="modal-body">{{ this.message }}</div>
            <div class="modal-footer">
                <button @click="$emit('closeModal')" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                    OK
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FlashComponent",
    props: ['message', 'show_modal'],
    data(){
        return {
             show: false
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
    min-width: 25%;
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
