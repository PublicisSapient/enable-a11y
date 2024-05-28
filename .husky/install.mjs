// This ensure that Husky is not installed and used in our CI/CD pipeline, but is otherwise automatically installed since it is only needed on commits. The following code was recommended by the Husky docs (https://typicode.github.io/husky/how-to.html).

// Skip Husky install in production and CI
if (process.env.NODE_ENV === "production" || process.env.CI === "true") {
    process.exit(0);
}
const husky = (await import("husky")).default;
console.log(husky());
