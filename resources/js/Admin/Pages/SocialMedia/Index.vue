<template>
    <div>
        <x-index-template :setup="setup" :listData="listData" :selected="selected">
            <x-table>
                <template #thead>
                    <x-tableth-checkbox v-if="this.isMultipleSelect"/>
                    <x-tableth>Social Media Type</x-tableth>
                    <x-tableth>Date</x-tableth>
                    <x-tableth>Author</x-tableth>
                    <x-tableth>Status</x-tableth>
                </template>
                <template #tbody>
                    <x-tabletr v-for="(record,index) in listData.data" v-bind:key="index" :row="record.uuid+'#'+index" :isSelected="isSelected(record.uuid+'#'+index)" :url="setup.settings.indexRoute+'/show/'+record.uuid">
                        <x-tabletd-checkbox v-if="this.isMultipleSelect" :item="record.uuid+'#'+listData.data.indexOf(record)" @onCheck="onCheck"/>
                        <x-tabletd>{{record.name}}</x-tabletd>
                        <x-tabletd>{{record.created_at}}</x-tabletd>
                        <x-tabletd>{{record.created_by}}</x-tabletd>
                        <x-tabletd>
                            <x-badge :class="setup.statuses[setup.statuses.findIndex(x => x.id ==record.status)].color">{{setup.statuses[setup.statuses.findIndex(x => x.id ==record.status)].caption}}</x-badge>
                        </x-tabletd>
                    </x-tabletr>
                </template>
            </x-table>
        </x-index-template>
    </div>
</template>
<script>
    import IndexMixin from '@/System/Mixins/CRUD/IndexMixin.js'
    export default{
        mixins:[IndexMixin],
    }
</script>
