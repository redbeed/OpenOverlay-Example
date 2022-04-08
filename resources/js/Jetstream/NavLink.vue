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
                return 'block px-2 py-2 font-bold rounded-md w-full ' + (this.active
                    ? 'text-flamingo-900 bg-flamingo-100 focus:outline-none focus:bg-flamingo-500 focus:text-white transition'
                    : 'text-gray-500 hover:text-flamingo-700 hover:bg-flamingo-100 focus:outline-none focus:text-flamingo-800 focus:border-gray-300 transition');
            }
        }
    })
</script>
