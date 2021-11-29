<div class="shadow-drop-center bg-white rounded shadow mt-8">
    <div class="border-b py-4 text-gray-700 text-center text-xl tracking-wider">
        Tailwind CSS and Select2 multiple example
    </div>
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        method="POST"
        autocomplete="on"
        novalidate
    >

        <div class="mb-4">
            <label class="block text-gray-700 text-md font-bold mb-2" for="pair">
                Choose your cities:
            </label>
            <select
                class="js-example-basic-multiple" style="width: 100%" 
                data-placeholder="Select one or more cities..."
                data-allow-clear="false"
                multiple="multiple"
                title="Select city...">
                <option>Amsterdam</option>
                <option>Rotterdam</option>
                <option>Den Haag</option>
            </select>
        </div>
        <div class="flex items-center justify-between">
            <a class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="#"> Submit
            </a>
            
            <a class="bg-transparent hover:bg-blue-600 active:bg-blue-700 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded focus:outline-none focus:shadow-outline" href="#"> Cancel
            </a>
        </div>
    </form>
</div>