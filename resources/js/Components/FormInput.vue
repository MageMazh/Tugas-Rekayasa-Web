<script setup>
import { ref } from "vue";
import { router} from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const title = ref('');
const body = ref('');

const createData = () => {

  if (title.value === '' || body.value === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Mohon untuk mengisi seluruh field yang ada!',
            confirmButtonText: 'OK',
        });
    } else {
        Swal.fire({
            icon: 'success',
            title: 'Menyimpan data',
            text: 'Catatan Anda sedang diproses!',
            showConfirmButton: false,
            timer: 1500,
        }).then(() => {
            router.post('/addNote', {
                'title': title.value,
                'description': body.value,
            });

            title.value = '';
            body.value = '';
        });
    }
}

</script>

<template>
  <form @submit.prevent class="flex flex-col gap-5">
    <input class="p-3 bg-transparent border-[1px] border-white rounded" type="text" v-model="title"
      placeholder="Title here ..." required />
    <textarea class="p-3 bg-transparent border-[1px] border-white rounded min-h-[175px]" type="text" v-model="body"
      placeholder="Your note here ..." required />
    <button type="submit" class="p-3 bg-transparent border-[1px] border-white rounded" @click="createData">Submit</button>
  </form>
</template>
