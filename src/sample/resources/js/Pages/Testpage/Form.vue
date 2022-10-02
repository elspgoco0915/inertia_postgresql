<template>
  <elerning-layout>
    <div>
       <!-- コンテンツ -->
       <h2 class="text-gray-700 text-3xl font-medium">学習状況</h2>
       <p>{{ test }}</p>
       <!-- -->
    </div>

    <section class="container">
      <input type="text" placeholder="郵便番号を入力" v-model="zipcode"/>
      <button @click="searchAddressInfo">住所自動入力</button>
        <p>都道府県：{{addressData['address1']}}</p>
        <p>住所1：{{addressData['address2']}}</p>
        <p>住所2：{{addressData['address3']}}</p>
    </section>


  </elerning-layout>
</template>

<style scoped>

</style>

<script>
    import { defineComponent } from 'vue'
    import ElerningLayout from '@/Layouts/ElerningLayout.vue'

    // let url = 'http://localhost/api/test?query=';
    let url = 'http://zipcloud.ibsnet.co.jp/api/search?zipcode=';

    export default defineComponent({
        components: {
          ElerningLayout,
        },
        props: {
            test: String,
        },
        mounted() {
          // console.log('test');
          // axios
          //   .get(url)
          //   // .get('@/api/test')
          //   // .then(response => (this.info = response))
          //   .then(response => console.log(response.data))
        },
        data() {
            return {
              zipcode: '',
              addressData: {}
            }
        },
        methods: {
            searchAddressInfo() {
              axios.get(url + this.zipcode).then((res) => {
                this.addressData = res.data.results[0];
              })
          },
        },
        computed: {
          filteredUsers: function() {
            // console.log('test');
          }
        },
    })
</script>