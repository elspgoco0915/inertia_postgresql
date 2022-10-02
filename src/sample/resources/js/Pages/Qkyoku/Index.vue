<template>
  <qkyoku-layout>
    <div>
       <!-- コンテンツ -->
       <h2 class="text-gray-700 text-3xl font-medium">学習状況</h2>
       <p>{{ test }}</p>
       <!-- -->
    </div>

<!--      <Link as="button" :href="route('qkyoku.search',{ type: type, queryWord: searchWord })" method="get" :data="test" preserve-state-->

      <Link as="button" :href="route('qkyoku.test', { forms: forms })" method="get" preserve-state
            class="border border-gray-400 m-1 p-1 text-sm">
          submit
      </Link>


      <div>
          <button v-on:click="openModal">Click!</button>
          <input type="text" v-model="inputText">
          <MyModal
              v-bind:message="inputText"
              v-show="showContent"
              v-on:from-child="closeModal">

              <div slot="title">テストタイトル</div>
              <p slot="body">あああ内容</p>

          </MyModal>

<!--          <emit-event v-on:from-child="receiveMessage"></emit-event>-->

      </div>


      <form action="">

<!--          <ul>-->
<!--              <li v-for="column in list" :key="column.item">{{ column.item }}</li>-->
<!--          </ul>-->


        <!--  for文         -->
          <ul>
              <li v-for="column in forms" :key="column">
                  <hr>
                  <h3>{{ column.no }}</h3>
                  <h4>{{ column.title }}</h4>
                  <p>{{ column.comment }}</p>
                      <p>title:</p>
                      <input type="text" v-model="column.title">
                  <br>
                      <p>comment:</p>
                      <textarea v-model="column.comment"></textarea>
              </li>
          </ul>

<!--          <button @click="showModal()">open modal</button>-->
      </form>



  </qkyoku-layout>
</template>

<style scoped>


</style>

<script>
    import { defineComponent } from 'vue'
    import QkyokuLayout from '@/Layouts/QkyokuLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'

    import draggable from 'vuedraggable'
    import DialogModal from '@/Jetstream/DialogModal.vue'
    import MyModal from "../../Layouts/parts/MyModal.vue";

    export default defineComponent({
        components: {
            MyModal,
          // ElerningLayout,
          QkyokuLayout,
          draggable,
          DialogModal,
          Link,
        },
        props: {
            test: String,
            time: String,
            arr: Array,
            // message: String,
        },
        data() {
            return {
                showContent: false,
                forms: [
                    {
                        no: 1,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 2,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 3,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 4,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 5,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 6,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 7,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 8,
                        title: '',
                        comment: '',
                    },
                    {
                        no: 9,
                        title: '',
                        comment: '',
                    },
                ],
                form_image: {
                    1: {
                        album_id: 1,
                        title: '',
                        comment: '',
                    },
                    2: {},
                    3: {},
                    4: {},
                    5: {},
                    6: {},
                    7: {},
                    8: {},
                    9: {},
                },
                inputText: '',
                // childText: '',
                // message: '',
            }
        },
        methods: {
            openModal() {
                console.log('test');
                this.showContent = true
            },
            closeModal(value) {
                this.showContent = false
                this.inputText = value;
                console.log(this.inputText);
            },
            // receiveMessage(text) {
            //     console.log('aaaaaaa');
            //     this.childText = text;
            //     console.log(this.childText);
            // },
            // clickEvent() {
            //     this.$emit('from-child');
            // },
        },
    })
</script>
