<template>
    <div v-if="visible" id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
        <span v-html="message"></span>
        <button type="button" class="btn-close" @click="closeAlert" aria-label="Close"></button>
    </div>
</template>

<script>
export default {
    props: {
        initialMessage: {
            type: String,
            default: "",
        },
        timeout: {
            type: Number,
            default: 2000,
        },
    },
    data() {
        return {
            message: this.initialMessage,
            visible: !!this.initialMessage,
        };
    },
    mounted() {
        if (this.visible) {
            this.autoDismiss();
        }
    },
    methods: {
        autoDismiss() {
            setTimeout(() => {
                this.visible = false;
            }, this.timeout);
        },
        closeAlert() {
            this.visible = false;
        },
    },
};
</script>