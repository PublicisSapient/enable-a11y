import fs from "fs";

const metadataFilePath = "templates/data/meta-info.json";
const siteSearchFilePath = "templates/data/site-search.json";

/* Read from site metadata file and create search directory based on existing information */
function updateSearchJSON() {
    const searchList = [];

    fs.readFile(metadataFilePath, (error, data) => {
        if (error) {
            console.log(`Error occurred in reading file ${metadataFilePath}`, error);
            return;
        }

        const obj = JSON.parse(data);
        let count = 0;

        for (const [key, entry] of Object.entries(obj)) {
            if (entry["searchable"] == true) {
                const searchEntry = {};

                try {
                    searchEntry["id"] = count;
                    searchEntry["title"] = entry["shortTitle"]? entry["shortTitle"] : entry["title"];
                    searchEntry["desc"] = entry["desc"];
                    searchEntry["link"] = `/${key}`;
                    searchList.push(searchEntry);
                } catch (e) {
                    console.log(`Error in adding key ${key}: ${e}`);
                }
            }
            count += 1;
        }

        try {
            fs.writeFileSync(
                siteSearchFilePath,
                JSON.stringify(searchList, null, 2),
                "utf-8",
            );
        } catch (e) {
            console.log(`Error in writing file ${siteSearchFilePath}}: ${e}`);
        }
    });
}

updateSearchJSON();
