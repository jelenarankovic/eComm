<template>
    <!-- <v-app> -->
    <div>
        <v-data-table
            :headers="headers"
            :items="bookables"
            :loading="loading"
            :items-per-page="5"
            :search="search"
            class="elevation-1"
        >
            <v-card>
                <v-card-title>
                    Bookables
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-card-title>
            </v-card>
            <template v-slot:[`item.actions`]="{ item }">
                <v-icon small @click="deleteItem(item)">
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>
        <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
                <v-card-title class="headline"
                    >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeDelete"
                        >Cancel</v-btn
                    >
                    <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                        >OK</v-btn
                    >
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
    <!-- </v-app> -->
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
