'use strict';

import Vue from 'vue';
import MemoTable from "../../vue/components/molecules/MemoTable";

let table = new Vue({
    el: '#memo-table',
    components: {
        MemoTable,
    },
})