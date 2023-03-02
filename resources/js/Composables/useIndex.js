import { usePage } from '@inertiajs/inertia-vue3'
import {Inertia} from "@inertiajs/inertia";
import { ref, watch } from 'vue';

//components
import xTable from '@/Components/Table/Table.vue'
import xTabletd from '@/Components/Table/Td.vue'
import xTabletdCheckbox from '@/Components/Table/TdCheckbox.vue'
import xTableth from '@/Components/Table/Th.vue'
import xTablethCheckbox from '@/Components/Table/ThCheckbox.vue'
import xTabletr from '@/Components/Table/Tr.vue'
import xBadge from '@/Components/Badge.vue'
import xIndexTemplate from '@/System/Pages/Templates/CRUD/Index.vue'

export const indexProps = {
    setup:Object,
    listData:Object,
}

const selected = ref([]);
const isMultipleSelect = ref(false);

export const useIndex = (props) => {

    function onCheck(item){
        if(selected.indexOf(item) === -1){
            selected.push(item);
        }else{
            selected.splice(selected.indexOf(item),1);
        }
    }
    function onRowClick(item){
        console.log(item)
        selected.value = [];
        selected.value.push(item);
        console.log(selected)
    }
    function isSelected(item){
        return selected.value.indexOf(item) === -1
        // if(selected.indexOf(item) === -1){
        //     return false;
        // }else{
        //     return true;
        // }
    }

    watch(isMultipleSelect, (newV, oldV) => {
        if(newV == false){
            selected.value = [];
        }
    });

    return {
        onCheck, 
        onRowClick,
        isSelected,
        xTable,
        xTabletd,
        xTabletdCheckbox,
        xTableth,
        xTabletr,
        xBadge,
        xIndexTemplate,
        selected,
        isMultipleSelect
    }
}