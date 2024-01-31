import React from "react";

function PostEditor() {
    const [value, setValue] = React.useState("");

    return (
        <div>
            <textarea
                rows={10}
                placeholder={"Write your post here..."}
                className={
                    "dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                }
                value={value}
                onChange={(e) => setValue(e.target.value)}
            />
            <div className={"flex flex-row-reverse"}>
                <small>Chars {value.length}</small>
            </div>
        </div>
    );
}

export default PostEditor;
