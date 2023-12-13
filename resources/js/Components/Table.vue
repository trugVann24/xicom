<script>
export default {};
</script>
<template>
    <div class="overflow-x">
        <table class="table-auto overflow-scroll w-full text-gray-500 text-left">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <slot name="header"></slot>
            </thead>
            <tbody class="bg-white ">
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>
