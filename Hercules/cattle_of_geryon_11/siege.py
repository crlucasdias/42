from datetime import datetime
import requests
import time
import threading
import os

url = input("URL: ")
results = {}
results["date"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
results["success"] = 0
results["failure"] = 0
results["elapsed_time"] = 0
results["total_transactions"] = 0

def show_log():
    file_str = (
        "###############\nResults: \nStart date: " + results["date"] + "\n" +
        "Success: " + str(results["success"]) + "\n" + "Failure: " + str(results["failure"]) + "\n" +
        "Total Requests: " + str(results["total_transactions"]) + "\n" +
        "Elapsed time: " + str(results["elapsed_time"]) + "\n" + "################"
    )
    print(file_str)
    check_log_folder()
    return (log_to_folder(file_str))
def check_log_folder():
    if not os.path.isdir("logs"):
        os.makedirs("logs")
    return
def log_to_folder(file_str):
    os.chdir("logs")
    file_list = os.listdir()
    count = 0
    for x in file_list:
        if x.endswith(".log"):
            count += 1
    f = open ('siege' + str(count + 1) + '.log', 'w')
    f.write(file_str)
    return

def check_url():
    try:
        response = requests.get(url)
    except:
        print("Check URL. ")
        quit()
    return
def do_requests(count):
    max_tests = 10
    count_tests = 0
    while count_tests < max_tests:
        try:
            response = requests.get(url, timeout=10)
            print("Code: ", response.status_code, "Thread: ", count)
            results["total_transactions"] += 1
            if response.status_code == 200:
                results["success"] += 1
            else:
                results["failure"] += 1
            count_tests += 1
        except:
            print("Error..")
    return

def main():
    clients = int(input("Number clients: "))
    check_url()
    count = 0
    threads = []
    start = time.time()
    try:
        for count in range(clients):
            t = threading.Thread(target=do_requests,args=[count])
            threads.append(t)
            t.start()
        count = 0
        for count in threads:
            t.join()
    except:
        print("Error")
        os._exit(1)
    time.sleep(3)
    results["elapsed_time"] += time.time() - start - 3
    show_log()
    return

if __name__== "__main__":
  main()