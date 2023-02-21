<template>
    <tr class="text-gray-400 hover:bg-gray-700 focus:bg-gray-700 border-b" :class="[rowNo % 2 == 0? 'bg-gray-800':'bg-gray-800',url != ''? 'cursor-pointer':'',isSelected? 'bg-gray-700':'']" @click="onclick" @dblclick="onDblClick">
        <slot></slot>
    </tr>
</template>
<script>
    import {Inertia} from "@inertiajs/inertia";
    export default{
        props:{row:{default:0},url:{default:''},isSelected:{default:false}},
        components:{Inertia},
        data(){
            return{
                rowNo:0,
                recordId:0,
            }
        },
        mounted(){
            var rowKeys = this.row.split('#');
            this.recordId = rowKeys[0];
            this.rowNo = rowKeys[1];
        },
        methods:{
            onclick(){
                if(this.url != ''){
                    this.$parent.$parent.$parent.onRowClick(this.row);
                }
            },
            onDblClick(){
                if(this.url != ''){
                    Inertia.visit(this.url);
                }
            }
        }
    }
</script>
