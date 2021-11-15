      <section>
        <div class=" mx-auto container ">
          <div class="flex flex-row justify-between border-b-2 border-purple-600 py-4 px-3">
            <h1 class="text-3xl font-bold text-gray-800 md:text-4xl">Project List</h1>
            <button class="c-btn-primary" @click="showModal = true">Add Project</button>
          </div>
          <div>
            <h2 class="mt-3 text-xl font-bold text-gray-800 md:text-2xl px-4">Project List</h2>
            <!-- modal -->
            <project-modal :showModal="showModal" @close="showModal = false" >
              <h2 class="text-3xl font-bold  text-gray-700 ">Add New Project</h2>
              <form @submit.prevent="addProject">
                <div class="w-full mt-4">
                  <input type="text"
                  v-model="project.project_name"
                  class="c-form-control"
                  placeholder="Project Name"
                  required >
                </div>
                <div class="w-full mt-4">
                  <input type="text"
                  v-model="project.project_description"
                  class="c-form-control"
                  placeholder="Project description"
                  required >
                </div>
                <div class="justify-end flex">
                  <button type="submit" class="c-btn-primary mt-4 text">Submit</button>
                </div>
              </form>
            </project-modal>
            <!-- end modal -->
            <!-- project card -->
            <section>
              <project-card
              :projects="projects" >
                
              </project-card>

            </section>
            <!-- end of project card -->
          </div>
          <div>
          </div>
        </div>
      </section>








=======================================================================






      <div class="flex justify-center">
        <section class="container ">
            <div class=" flex justify-between mb-3 py-3 ">
                <h1 class="text-2xl font-bold text-gray-800 uppercase lg:text-3xl" >Project Dashboard</h1>
                <div class="grid grid-cols-2 gap-2">
                    <button class="c-btn-primary" @click="deleteProjectModal = true">delete</button>
                    <button class="c-btn-primary" @click="updateProjectModal = true">update</button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4" >
        <!-- project with collaborator card -->
                <div class="px-8 py-4 mx-auto bg-white rounded-lg shadow-md  w-full  ">
                    <div v-if="project === null" class="bg-rose-600" >
                        loading
                    </div>
                    <div v-else>
                        <div class="flex justify-between mb-2 pb-2 border-b-2 border-purple-500">
                            <h1 class="text-2xl font-bold text-gray-800 uppercase lg:text-3xl hover:text-gray-700">{{ project.project_name }}</h1>
                            <button class="c-btn-primary" @click="showModal = true" >Add Collaborator</button>
                        </div>

                        <div class="">
                            <p class="text-md  text-gray-700 lg:text-xl mb-2">{{ project.project_description }}</p>
                            <div v-for="user in project.collaborator" :key="user.id" class="bottom-0 " >
                                <button class="block px-5 py-2 mt-4 font-medium leading-4 text-center text-white capitalize bg-purple-400 rounded-lg lg:mt-0  lg:w-auto ">
                                    {{user.name}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- end of project with collaborator card -->
        <!-- announcement card -->
                <div class="px-8 py-4 mx-auto bg-white rounded-lg shadow-md  w-full overscroll-contain  h-60 overflow-auto   ">
                    <div class="mb-2 pb-2 border-b-2 border-purple-500">
                        <h1 class="text-2xl font-bold text-gray-800 uppercase lg:text-3xl hover:text-gray-700">Announcement</h1>
                    </div>
                </div>
        <!-- end of announcement card -->
            </div>
            <div class="grid grid-cols-3 gap-4 mt-3">
                <!-- todo list card -->
                <div class="px-8 py-4 mx-auto bg-white rounded-lg shadow-md  w-full col-span-2" >
                    <div class="flex justify-between mb-2 pb-2 border-b-2 border-purple-500">
                        <h1 class="text-2xl font-bold text-gray-800 uppercase lg:text-3xl hover:text-gray-700">Todo List</h1>
                    </div>
                    <todo-list
                     >

                    </todo-list>
                </div>
                <!-- end of todo list card -->
                <!-- message card -->
                <div class="px-8 py-4 mx-auto bg-white rounded-lg shadow-md  w-full">
                    <div class="flex justify-between mb-2 pb-2 border-b-2 border-purple-500">
                        <h1 class="text-2xl font-bold text-gray-800 uppercase lg:text-3xl hover:text-gray-700">Project Chat</h1>
                    </div>
                </div>
                <!-- end of message card -->
            </div>
        </section>

        <!-- add collaborator modal  -->
        <project-modal :showModal="showModal" @close="showModal = false" > 
              <h2 class="text-3xl font-bold  text-gray-700 ">Add New Collaborator</h2>
              <form @submit.prevent="addCollaborator">
                <div class="w-full mt-4">
                  <input type="text"
                  v-model="newCollaborator"
                  class="c-form-control"
                  placeholder="collaborator name"
                  required >
                </div>
                <div class="justify-end flex">
                  <button type="submit" class="c-btn-primary mt-4 text">Submit</button>
                </div>
              </form>
        </project-modal>
        <!-- delete modal  -->
        <project-modal :showModal="deleteProjectModal" @close="deleteProjectModal = false" > 
            <div class="justify-between flex">
              <h2 class="text-3xl font-bold  text-gray-700 ">Confirm delete</h2>
              <div class="grid grid-cols-2 gap-2">
                  <button class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-red-500 rounded hover:bg-red-400 focus:outline-none" @click="deleteProject">Confirm</button>
                  <button class="c-btn-primary" @click="deleteProjectModal = false">Cancel</button>
              </div>
            </div>
        </project-modal>
        <!-- update modal -->
        <project-modal :showModal="updateProjectModal" @close="updateProjectModal = false" > 
              <h2 class="text-3xl font-bold  text-gray-700 ">Update Project Information</h2>
              <form @submit.prevent="addCollaborator">
                <div class="w-full mt-4">
                  <input type="text"
                  v-model="newCollaborator"
                  class="c-form-control"
                  placeholder="collaborator name"
                  required >
                </div>
                <div class="justify-end flex">
                  <button type="submit" class="c-btn-primary mt-4 text">Submit</button>
                </div>
              </form>
        </project-modal>
    </div>