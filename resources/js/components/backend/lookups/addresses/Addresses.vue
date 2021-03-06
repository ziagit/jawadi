<template>
<div class="addresses" v-if="addresses">
    <!-- delete dialog-->
    <md-dialog-confirm :md-active.sync="deleteTogal" md-title="Are your sure you want to delete?" md-content md-confirm-text="OK" md-cancel-text="Cancel" @md-confirm="confirm()" @md-cancel="cancel" />
    <!-- edit dialog -->
    <md-dialog :md-active.sync="editTogal">
        <md-dialog-title>Update address data</md-dialog-title>
        <md-dialog-content>
            <EditAddress v-on:close-dialog="refresh" :address="address" />
        </md-dialog-content>
    </md-dialog>
    <!-- add dialog -->
    <md-dialog :md-active.sync="addTogal">
        <md-dialog-title>Add new address</md-dialog-title>
        <md-dialog-content>
            <AddAddress v-on:close-dialog="refresh" />
        </md-dialog-content>
    </md-dialog>

    <md-table md-sort="name" md-sort-order="asc" md-card>
        <md-table-toolbar>
            <div class="md-toolbar-section-start">
                <h1 class="md-title">Addresses</h1>
            </div>

            <md-field md-clearable class="md-toolbar-section-end">
                <md-input placeholder="Search by name..." v-model="keywords" />
            </md-field>
        </md-table-toolbar>

        <md-table-empty-state md-label="No state found" :md-description="`No state found for this query. Try a different search term or create a new state.`">
            <md-button class="md-primary md-raised" @click="add()">Create new address</md-button>
        </md-table-empty-state>
        <md-table-row>
            <md-table-head md-numeric>ID</md-table-head>
            <md-table-head>Name</md-table-head>
            <md-table-head>City</md-table-head>
            <md-table-head>Actions</md-table-head>
        </md-table-row>
        <md-table-row v-for="address in addresses.data" :key="address.id">
            <md-table-cell md-numeric>{{ address.id }}</md-table-cell>
            <md-table-cell>{{ address.name }}</md-table-cell>
            <md-table-cell>{{ address.city.name }}</md-table-cell>

            <md-table-cell md-label="Actions">
                <md-button class="md-icon-button md-primary" @click="edit(address)">
                    <md-icon>edit</md-icon>
                </md-button>
                <md-button class="md-icon-button md-accent" @click="remove(address.id)">
                    <md-icon>delete</md-icon>
                </md-button>
            </md-table-cell>
        </md-table-row>

    </md-table>
    <pagination :limit="4" :data="addresses" @pagination-change-page="get"></pagination>
    <md-button class="md-fab md-primary add-btn" @click="add()">
        <md-icon>add</md-icon>
        <md-tooltip>Add new address</md-tooltip>
    </md-button>
</div>
</template>

<script>
import AddAddress from "./AddAddress";
import EditAddress from "./EditAddress";
import axios from "axios";

export default {
    name: "address",
    data: () => ({
        keywords: null,
        addresses: null,
        address: null,
        addTogal: false,
        editTogal: false,
        deleteTogal: false,
    }),
    watch: {
        keywords(after, before) {
            this.search();
        },
    },
    methods: {
        search() {
            axios
                .get("admin/search-address", {
                    params: {
                        keywords: this.keywords
                    }
                })
                .then((res) => {
                    this.addresses = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        get(page = 1) {
            axios
                .get("admin/addresses?page=" + page)
                .then((res) => {
                    console.log("address: ", res.data.data)
                    this.addresses = res.data;
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },

        add() {
            this.addTogal = true;
            this.stateData = this.states;
        },
        refresh() {
            this.addTogal = false;
            this.editTogal = false;
            this.get();
        },
        edit(data) {
            this.editTogal = true;
            this.address = data;
        },
        remove(id) {
            this.deleteTogal = true;
            this.selectedId = id;
        },

        confirm() {
            axios
                .delete("admin/addresses/" + this.selectedId)
                .then((res) => {
                    console.log("deleted", res.data);
                    this.get();
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });
        },
        cancel() {},
    },
    created() {
        this.get();
    },

    components: {
        AddAddress,
        EditAddress,
    },
};
</script>

<style lang="scss" scoped>
.addresses {
    width: 100%;

    .add-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }
}
</style>
