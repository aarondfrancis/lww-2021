exports.handler = async function () {
    let runtime = process.env.AWS_EXECUTION_ENV;

    return `Hello from ${runtime} Lambda!`
}
