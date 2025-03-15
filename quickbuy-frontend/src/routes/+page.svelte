<script lang="ts">
    import axios from "axios";
    import { onMount } from "svelte";

    let data : any = ""

    onMount(()=>{
        axios.get('http://127.0.0.1:8000/api/items/')
        .then((res: any)=>{
            data = res.data
            console.log(data[0].name)
        }).catch((err:any)=>{

        })
    })

	let name: string = 'world';

	function greet(name: string) {
		alert(`Hello, ${name}!`);
	}
</script>

<h1>Welcome to SvelteKit</h1>

<h1>
    {#each data as item}
        {item.name} <br>
    {/each}
</h1>

<p>Visit <a href="https://svelte.dev/docs/kit">svelte.dev/docs/kit</a> to read the documentation</p>
