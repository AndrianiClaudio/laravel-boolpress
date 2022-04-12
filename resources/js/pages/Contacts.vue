<template>
    <div class="container">
        <div class="row">
            <div class="col pt-3">
                <h1>Contatti</h1>
            </div>
        </div>

        <form enctype="multipart/form-data">
            <div class="row mt-3">
                <div class="col">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Nome"
                        aria-label="First name"
                        name="firstname"
                        v-model="form.firstname"
                    />
                </div>
                <div class="col">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cognome"
                        aria-label="Last name"
                        name="lastname"
                        v-model="form.lastname"
                    />
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="message" class="form-label">Messaggio</label>
                    <textarea
                        class="form-control"
                        id="message"
                        rows="3"
                        name="message"
                        v-model="form.message"
                    ></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="mb-3">
                        <label for="file" class="form-label"
                            >Carica un file</label
                        >
                        <input
                            class="form-control"
                            type="file"
                            id="file"
                            name="file"
                            @change="setFile($event.target.files)"
                        />
                    </div>
                </div>
            </div>

            <input
                type="submit"
                value="Invio"
                class="btn btn-primary"
                @click.prevent="sendMessage"
            />
        </form>
    </div>
</template>

<script>
export default {
    name: "Contacts",
    data() {
        return {
            form: {
                firstname: "",
                lastname: "",
                message: "",
                file: "",
            },
        };
    },
    methods: {
        setFile(value) {
            console.log(value);
            this.form.file = value;
        },
        sendMessage() {
            const formData = new FormData();
            formData.append("file", this.form.file[0]);
            formData.append("firstname", this.form.firstname);
            formData.append("lastname", this.form.lastname);
            formData.append("message", this.form.message);

            const headers = {
                "Content-Type": "multipart/form-data",
                Authorization: "Bearer jhgf678iklp987t",
            };
            // console.log(headers);
            const url = "http://127.0.0.1:8000/api/v1/contacts";

            axios
                .post(url, formData, { headers })
                .then((result) => {
                    console.log(result.data, result.status); // HTTP status //  // binary representation of the file
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>

<style lang="scss" scoped></style>
