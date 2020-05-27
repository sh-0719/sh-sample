<template>
    <div>
        <table>
            <tr>
                <th>内容</th>
                <th>作成日時</th>
                <th></th>
            </tr>
            <tr v-for="memo in memos" :key="memo.id">
                <td>{{ memo.content }}</td>
                <!-- TODO: 作成日時の表記をyyyy年mm月dd日 hh:mm:ssにする -->
                <td>{{ memo.created_at }}</td>
                <td>
                    <form method="post" :action="getDestroyUrl(memo.id)" accept-charset="UTF-8">
                        <input type="hidden" name="_token" :value="csrf">
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="submit" value="削除">
                    </form>
                </td>
            </tr>
        </table>
    </div>
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
            }
        }
    }
</script>

<style scoped>

</style>