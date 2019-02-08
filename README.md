#Setup
1. build 
    ```bash 
    docker compose up -d
    ```
2. install dependencies 
    ```bash 
    docker run --rm --interactive --tty --volume $PWD:/app composer ìnstall --ignore-platform-reqs
    ```
3. go [here](localhost::8080)
