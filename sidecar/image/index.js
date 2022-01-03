const {registerFont, createCanvas} = require('canvas')
const path = require('path');

// This is kind of expensive, but it *only* happens when a container is
// booted cold! So you can do any "expensive" init work outside of the
// handler, and it will stay there as long as the container stays warm.
registerFont(path.resolve(`${__dirname}/fonts/Helvetica.ttf`), {
    family: 'Helvetica'
})

// This is run every time the function is invoked. Everything in this
// local scope is fresh from request to request.
exports.handler = async function (event) {
    const width = 1200
    const height = 630

    const canvas = createCanvas(width, height)
    const context = canvas.getContext('2d')

    context.fillStyle = '#00ff00'
    context.fillRect(0, 0, width, height)

    context.font = 'bold 70pt Helvetica'
    context.textAlign = 'center'
    context.textBaseline = 'top'
    context.fillStyle = '#3574d4'

    const text = event.text;

    const textWidth = context.measureText(text).width
    context.fillRect(600 - textWidth / 2 - 10, 170 - 5, textWidth + 20, 120)
    context.fillStyle = '#fff'
    context.fillText(text, 600, 170);

    return canvas.toDataURL('image/jpeg').replace(/^data:image\/\w+;base64,/, "");
}
