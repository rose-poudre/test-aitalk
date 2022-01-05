<template>
    <div class="style1">
        <h1>{{ message }}</h1>
        <p v-if="errored">サーバとの通信でエラーが発生しています</p>
        <p v-for="user in users">{{ user.name.title }} {{ user.name.last }}</p>
        <button
      class="btn-sm shadow-none border border-primary p-2"
      @click="clickData">
      <font size="3">axiosを使いデータを取得</font>
    </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
           message: 'Axios',
            users: [],
            errored: false
        };
    },
methods: {
      clickData() {
axios.get('https://randomuser.me/api/',
            {
              params: {
                results: '5'
              }
            })
        .then(response => {this.users = response.data.results})
        .catch(error => {console.log(error)this.errored = true})
    },
    },
}
</script>