<template>
    <div>
        <v-card>
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="bookables"
                :loading="loading"
                :items-per-page="5"
                :search="search"
                class="elevation-1"
            ></v-data-table>
        </v-card>
    </div>

</template>

<script>
export default {
    data() {
        return {
            search: "",
            loading: false,
            bookables: [],
            dialogDelete: false,
            headers: [
                {
                    text: "ID",
                    value: "id",
                    width: "50"
                },
                {
                    text: "Title",
                    value: "title"
                },
                {
                    text: "Description",
                    value: "description"
                },
                { text: "Actions", value: "actions", sortable: false }
            ]
        };
    },
    created() {
        this.fetchData();
    },
    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        }
    },
    methods: {
        fetchData() {
            this.loading = true;
            axios.get("/api/bookables").then(response => {
                this.bookables = response.data.data;
                console.log(this.bookables);
                this.loading = false;
            });
        },
        deleteItem(item) {
            this.editedIndex = this.bookables.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.bookables.splice(this.editedIndex, 1);
            this.closeDelete();
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        }
    }
};
</script>
