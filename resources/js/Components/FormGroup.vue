<template>
    <div class="flex flex-col p-2">
        <div class="pb-1 text-sm text-gray-400"><slot name="label"></slot></div>
        <div class="flex flex-col"><slot name="value"></slot></div>
    </div>
</template>
