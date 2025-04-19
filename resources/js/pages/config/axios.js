import axios from "axios";

const instance = axios.create({
    baseURL: "http://localhost/pranav/task_manager/" // Your API base URL
});

export default instance;
