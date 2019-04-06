import os, sys
import shutil

def deal_with_folders(libft):
    path = os.getcwd()
    print("\n------- Verifying Folders ---------")
    if os.path.exists(path + "/src") == False:
        os.mkdir(path + "/src")
    if os.path.exists(path + "/lib") == False:
        os.mkdir(path + "/lib")
    if libft == "1":
        libft_src = os.path.expanduser('~') + "/libft"
        libft_dest = path + "/lib/libft"
        if os.path.exists(libft_src):
            try:
                shutil.copytree(libft_src,libft_dest)
                shutil.move(libft_dest + "/libft.h",  path + "/lib")
            except:
                print("Already have one libft.")
        else:
            print("Sorry, but libft isnt on home dir")
    print("Done..\n-----------------------------------\n")
    return

def create_c_make_file(libft):
    main_f = open("main.c", "w+")
    main_f.write("int main() { \n \n \n }")
    main_f.close()
    print("\n------- Makefile ---------")
    make_str = "PATH_SRC = $(wildcard src/*.c) \n"
    make_str += "PATH_LIB = $(wildcard lib/*.c)\n"
    if libft == "1":
        make_str += "PATH_LIBFT = $(wildcard lib/libft/*.c)\n"
    make_str += "PATH_MAIN = $(wildcard *.c)\n"
    make_str += "SRC = $(PATH_SRC)\n"
    make_str += "SRC += $(PATH_LIB)\n"
    if libft == "1":
        make_str += "SRC += $(PATH_LIBFT)\n"
    make_str += "SRC += *.c\n"
    make_str += "OBJ = $(SRC:.c=.o)\n"
    make_str += "FLAGS = gcc -Wall -Wextra -Werror\n"
    make_str += "DEL = rm -rf \n \n"
    make_str += "all: \n"
    make_str += "\t $(FLAGS) $(SRC) -I . \n \n"
    make_str += "clean: \n"
    make_str += "\t $(DEL) $(OBJ) \n \n"
    make_file = open("Makefile", "w+")
    make_file.write(make_str)
    make_file.close()
    print("Done..\n--------------------\n")
    return

def create_c_project():
    print("### C Project.. ###")
    print("Copy Libft from your home directory?")
    print("1 - Yes\n2 - No")
    libft = input("R: ")
    deal_with_folders(libft)
    create_c_make_file(libft)
    main_f = open("main.c", "w+")
    main_f.write("int main() { \n \n \n }")
    main_f.close()
    return

def start_git(project):
    print("\n### Git Options ###")
    print("1 - Start a new git Repo \n2 - Clone a git repo\nDefault - no git")
    git_type = input("R: ")
    print("\n------- Git ---------")
    if (git_type == "1"):
        os.system("rm -rf .git")
        os.system("git init")
    elif (git_type == "2"):
        git_url = input("Url: ")
        folder_name = input("Folder name: ")
        try: 
            os.system("rm -rf .git")
            cmd = "git clone " + git_url + " " + folder_name
            os.system(cmd)
            old_directory = os.getcwd()
            os.chdir(folder_name)
            shutil.move(old_directory + "/"+ os.path.basename(__file__), os.getcwd())
        except:
            print("----- Invalid usage -------")
            sys.exit()
    if os.path.exists(os.getcwd() + "/.gitignore") == False:
        git_ignore = open(".gitignore", "w+")
        print(".gitignore: " + os.path.basename(__file__))
        git_ignore.write(os.path.basename(__file__))
        git_ignore.close()
    print("Done..\n--------------------\n")
    if project == 1:
        create_c_project()
    return

def get_project_language(avaliable_languages):
    print("Avaliable Languages: ")
    for i in range(len(avaliable_languages)):
        print(i + 1, "-", avaliable_languages[i])
    try: 
        language = int(input("R: "))
    except:
        language = 0
    return language

def main():
    supported_languages = ["C","Exit"]
    language = get_project_language(supported_languages)
    count = len(supported_languages)
    if language > 0 and language < count:
        start_git(language)
    elif language == count:
        print("Exiting...!")
    else:
        print("Incorrect option. Try again")

if __name__== "__main__":
  main()
