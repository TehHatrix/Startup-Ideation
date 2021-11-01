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