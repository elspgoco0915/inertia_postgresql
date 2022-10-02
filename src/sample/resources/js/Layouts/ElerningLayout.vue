 <template>
    <div>
        <!-- header -->
        <Header />

        <button @click="show = !show" class="text-gray-500 focus:outline-none text-5xl md:hidden">
          :::
        </button>

        <!-- サイドバーとコンテンツを囲う -->
        <div class="flex flex-row min-h-full">
            
            <transition name="fade">
            <!-- left sidebar area -->
            <div v-if="show" class="absolute bg-gray-400 w-64 min-h-full z-50 md:relative">
              <div class="w-full flex flex-col text-center">
                <div class="hogehoge w-full display:block hover:bg-fuchsia-600 mt-2 p-5">
                  <a href="/">HOME - ICON</a>
                </div>

                <Link :href="route('course.category', { category : 'level1'})" class="w-full display:block hover:bg-fuchsia-600 mt-2 p-5">
                     Level1
                 </Link>
                  <Link :href="route('course.category', { category : 'level2'})" class="w-full display:block hover:bg-fuchsia-600 mt-2 p-5">
                     Level2
                 </Link>
                 <Link :href="route('course.category', { category : 'level3'})" class="w-full display:block hover:bg-fuchsia-600 mt-2 p-5">
                     Level3
                 </Link>                 
              </div>
            </div>
            </transition>

            <!-- right content area -->
            <div class="bg-gray-100 w-full p-5">
                <!-- Page Content -->
                <main>
                    <slot></slot>
                </main>
            </div>

        </div>
    </div>
 </template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .3s ease;
}

.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>


 <script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import Header from '@/Layouts/parts/Header.vue';

    export default defineComponent({
        props: {

        },
        components: {
            Link,
            Header,
        },
        data() {
            return {
                show: true,
                width: window.innerWidth,
            }
        },
        methods: {
            handleResize() {
                this.width = window.innerWidth;
                this.changShow();   
            },
            changShow() {
                if(this.width >= 768){
                    this.show = true;
                }else{
                    this.show = false;
                }
            }
        },
        mounted: function () {
          window.addEventListener('resize', this.handleResize);
          this.changShow(); 
        },
        beforeDestroy: function () {
          window.removeEventListener('resize', this.handleResize);
        }
    })
 </script>