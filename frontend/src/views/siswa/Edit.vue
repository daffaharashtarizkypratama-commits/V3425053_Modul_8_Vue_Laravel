<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h4>EDIT DATA SISWA</h4>
            <hr />

            <form @submit.prevent="update">
              <!-- Nama Siswa -->
              <div class="mb-3">
                <label for="nama" class="form-label fw-bold">
                  Nama Siswa
                </label>
                <input
                  id="nama"
                  type="text"
                  class="form-control"
                  v-model="post.nama"
                  placeholder="Masukkan nama siswa"
                />
                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                  {{ validation.nama[0] }}
                </div>
              </div>

              <!-- Alamat -->
              <div class="mb-3">
                <label for="alamat" class="form-label fw-bold"> Alamat </label>
                <input
                  id="alamat"
                  type="text"
                  class="form-control"
                  v-model="post.alamat"
                  placeholder="Nama jalan dan nomor rumah"
                />
                <div v-if="validation.alamat" class="mt-2 alert alert-danger">
                  {{ validation.alamat[0] }}
                </div>
              </div>

              <!-- Kota -->
              <div class="mb-3">
                <label for="kota" class="form-label fw-bold"> Kota </label>
                <input
                  id="kota"
                  type="text"
                  class="form-control"
                  v-model="post.kota"
                  placeholder="Masukkan nama kota tempat tinggal"
                />
                <div v-if="validation.kota" class="mt-2 alert alert-danger">
                  {{ validation.kota[0] }}
                </div>
              </div>

              <!-- Provinsi -->
              <div class="mb-3">
                <label for="provinsi" class="form-label fw-bold">
                  Provinsi
                </label>
                <input
                  id="provinsi"
                  type="text"
                  class="form-control"
                  v-model="post.provinsi"
                  placeholder="Masukkan nama provinsi tempat tinggal"
                />
                <div v-if="validation.provinsi" class="mt-2 alert alert-danger">
                  {{ validation.provinsi[0] }}
                </div>
              </div>

              <!-- E-mail -->
              <div class="mb-3">
                <label for="email" class="form-label fw-bold"> E-mail </label>
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  v-model="post.email"
                  placeholder="Masukkan alamat email siswa"
                />
                <div v-if="validation.email" class="mt-2 alert alert-danger">
                  {{ validation.email[0] }}
                </div>
              </div>

              <button type="submit" class="btn btn-primary">SIMPAN</button>

              <router-link
                :to="{ name: 'siswa.index' }"
                class="btn btn-secondary ms-2"
              >
                KEMBALI
              </router-link>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";

export default {
  setup() {
    // Initial state
    const post = reactive({
      nama: "",
      alamat: "",
      kota: "",
      provinsi: "",
      email: "",
    });

    // State validation
    const validation = ref({});

    // Vue Router
    const router = useRouter();
    const route = useRoute();

    // Mengambil data siswa berdasarkan ID
    onMounted(() => {
      axios
        .get(`http://localhost:8000/api/siswa/${route.params.id}`)
        .then((response) => {
          // Menyesuaikan respons dengan API Laravel
          const siswa = response.data.data ?? response.data;

          post.nama = siswa.nama;
          post.alamat = siswa.alamat;
          post.kota = siswa.kota;
          post.provinsi = siswa.provinsi;
          post.email = siswa.email;
        })
        .catch((error) => {
          console.error("Gagal mengambil data siswa:", error);
          alert("Data siswa gagal dimuat.");
        });
    });

    // Memperbarui data siswa
    function update() {
      axios
        .put(`http://localhost:8000/api/siswa/${route.params.id}`, {
          nama: post.nama,
          alamat: post.alamat,
          kota: post.kota,
          provinsi: post.provinsi,
          email: post.email,
        })
        .then(() => {
          // Kembali ke daftar siswa
          router.push({
            name: "siswa.index",
          });
        })
        .catch((error) => {
          // Menampilkan pesan validasi Laravel
          if (error.response && error.response.status === 422) {
            validation.value = error.response.data.errors;
          } else {
            console.error("Gagal memperbarui data siswa:", error);
            alert("Data siswa gagal diperbarui.");
          }
        });
    }

    return {
      post,
      validation,
      router,
      update,
    };
  },
};
</script>

<style>
body {
  background: lightgray;
}
</style>
