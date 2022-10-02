<template>
    <div id="overlay" v-show="showContent">
        <div id="content">
            <h1><slot name="title">タイトル</slot></h1>
            <p>this is modal.</p>
            <p>{{ message }}</p>
            <input type="text" v-model="sendText">
            <p><button v-on:click="clickEvent">close</button></p>
            <slot name="body">内容</slot>
<!--            <p><button v-on:click="$emit('from-child')">close</button></p>-->
        </div>
    </div>
</template>

<style scoped>
    /* modal */
    #overlay {
        /*　要素を重ねた時の順番　*/
        z-index:1;

        /*　画面全体を覆う設定　*/
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-color:rgba(0,0,0,0.5);

        /*　画面の中央に要素を表示させる設定　*/
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #content{
        z-index:2;
        width:50%;
        padding: 1em;
        background:#fff;
    }

</style>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    data() {
        return {
            sendText: '',
        }
    },
    methods: {
        clickEvent() {
            this.$emit('from-child', this.sendText);
        },
    },
    props: {
        message: String,
    }
})
</script>
