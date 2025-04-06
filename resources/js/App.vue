<template>
    <h1 class="mt-4 text-center">
        Country Encyclopedia
    </h1>
    <country-list :initial-countries="{{ $countries->toJson() }}"></country-list>
</template>