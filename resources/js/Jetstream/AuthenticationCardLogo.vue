<template>
    <Link :href="'/'">
        <ApplicationLogo class="h-12"></ApplicationLogo>
    </Link>
</template>

<script>
import {defineComponent} from 'vue'
import {Link} from '@inertiajs/inertia-vue3';
import ApplicationLogo from "./ApplicationLogo";

export default defineComponent({
    components: {
        ApplicationLogo,
        Link,
    },
})
</script>
