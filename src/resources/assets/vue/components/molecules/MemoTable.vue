<template>
    <table class="table table-sm table-hover">
        <thead class="thead-light">
        <tr>
            <th>内容</th>
            <th>作成日時</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="memo in memos" :key="memo.id">
            <td>{{ memo.content }}</td>
            <!-- TODO: 作成日時の表記をyyyy年mm月dd日 hh:mm:ssにする -->
            <td>{{ memo.created_at }}</td>
            <td>
                <a :href="getEditUrl(memo.id)">
                    <button type="submit" class="btn btn-outline-primary">編集</button>
                </a>
            </td>
            <td>
                <form method="post" :action="getDestroyUrl(memo.id)" accept-charset="UTF-8">
                    <input type="hidden" name="_token" :value="csrf">
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-outline-danger">削除</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "MemoTable",
        props: {
            memos: {
                type: Object,
                required: true,
            },
            appurl: {
                type: String,
                required: true,
            },
        },
        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods: {
            getDestroyUrl(id) {
                return this.appurl + '/memo/' + id + '/destroy';
            },
            getEditUrl(id) {
                return this.appurl + '/memo/' + id  + '/edit';
            }
        }
    }
</script>

<style scoped>

</style>