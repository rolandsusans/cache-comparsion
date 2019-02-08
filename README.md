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

#Results

```
Cached APCu | Times: 10 | Process took 1.7811379432678 seconds.
Cached APCu | Times: 10 | Memory allocated in APCu RAM 11.65 mb file.
Cached APCu | Times: 10 | PHP peak usage 112.03 mb.


Without cache Version | Times: 10 | Process took 3.3621900081635 seconds.
Without cache Version | Times: 10 | Memory allocated in APCu RAM NAN b file.
Without cache Version | Times: 10 | PHP peak usage 115.59 mb.
```
