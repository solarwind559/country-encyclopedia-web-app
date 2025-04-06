<template>
    <button
        type="submit"
        class="custom-btn"
        @mouseover="hoverImage = true"
        @mouseleave="hoverImage = false"
        @mousedown="activeImage = true"
        @mouseup="activeImage = false"
    >
        <img
            :src="activeImage ? activeSrc : hoverImage ? hoverSrc : defaultSrc"
            :alt="activeImage ? activeAlt : hoverImage ? hoverAlt : defaultAlt"
            width="20"
            height="20">
    </button>
</template>

<script>
export default {
    props: {
        isFavorite: {
            type: [Boolean, Number],
            required: true,
        },
    },
    data() {
        return {
            hoverImage: false, // hover state
            activeImage: false, // active state
        };
    },
    computed: {
        defaultSrc() {
            return this.isFavorite
                ? '/svg-icons/heart-filled.svg'
                : '/svg-icons/heart-outline.svg';
        },
        hoverSrc() {
            return this.isFavorite
                ? '/svg-icons/heart-outline.svg' // when hovered
                : '/svg-icons/heart-filled.svg';
        },
        activeSrc() {
            return '/svg-icons/heart-active.svg'; // on active state
        },
        defaultAlt() {
            return this.isFavorite ? 'Unfavorite' : 'Favorite';
        },
        hoverAlt() {
            return this.isFavorite ? 'Favorite' : 'Unfavorite';
        },
        activeAlt() {
            return 'Clicking...';
        },
    },
};
</script>
