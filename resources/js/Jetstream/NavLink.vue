<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
            classes() {
                return 'inline-flex items-center px-2 py-1 text-sm font-medium leading-5 rounded-md my-3 ' + (this.active
                    ? 'text-flamingo-900 bg-flamingo-100 focus:outline-none focus:bg-flamingo-500 focus:text-white transition'
                    : 'text-gray-500 hover:text-gray-700 hover:bg-flamingo-50 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition');
            }
        }
    })
</script>
