<template>
    <div class="inline-block bg-white border border-gray-400 rounded-sm">
        <button @click="decreaseQuantity" class="bg-white px-2 border-r-[1px] border-gray-400 text-xs"><i
                class='bx bx-minus'></i></button>
        <input type="number" v-model.number="quantity" :max="maxQuantity"
            class="bg-white border-none w-[60px] text-center text-sm focus:ring-0 text-black" min="1" />
        <button @click="increaseQuantity" class="bg-white px-2 border-l-[1px] border-gray-400 text-xs"><i
                class='bx bx-plus'></i></button>
    </div>
</template>

<script>
export default {
    props: {
        maxQuantity: Number
    },
    data() {
        return {
            quantity: 1,
        };
    },
    methods: {
        increaseQuantity() {
            if (this.quantity < this.maxQuantity) {
                this.quantity++;
            }
        },
        decreaseQuantity() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },
    },
};
</script>
