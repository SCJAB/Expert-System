<template>
    <div>
        <p>Details for Taker {{ takerID }}</p>
    </div>
</template>

<script>
export default {
    setup() {
        definePageMeta({
            layout: false
        });

        const { takerID } = useRoute().params;

        return {
            takerID
        };
    }
};
</script>

<style>

</style>
