"use strict";

productScroll();

function productScroll() {
    const nextButtons = document.getElementsByClassName("pro-next");
    const prevButtons = document.getElementsByClassName("pro-prev");
    const contentSections = document.getElementsByClassName("content");

    // Initialize position for each content section
    const positions = Array.from(contentSections).map(() => 0);

    Array.from(contentSections).forEach((contentDiv, index) => {
        const productGroupDiv = contentDiv.querySelector('.product-group');
        const productGroupId = productGroupDiv.id;

        // Add event listener for the previous button
        prevButtons[index].addEventListener("click", function () {
            if (positions[index] > 0) {
                positions[index] -= 1;
                translateX(positions[index], productGroupId);
            }
        });

        // Add event listener for the next button
        nextButtons[index].addEventListener("click", function () {
            if (positions[index] < hiddenItems(productGroupId)) {
                positions[index] += 1;
                translateX(positions[index], productGroupId);
            }
        });
    });
}

function hiddenItems(elementID) {
    const items = getCount(elementID, false);
    const visibleItems = Math.floor(document.getElementById("slider").offsetWidth / 210);
    return items - visibleItems;
}

function translateX(position, elementID) {
    const slide = document.getElementById(elementID);
    slide.style.transform = `translateX(${-position * 650}px)`;
}

function getCount(parent, getChildrensChildren) {
    let relevantChildren = 0;
    const getElement = document.getElementById(parent);
    const children = getElement.children; // Use children instead of childNodes for better performance
    for (let i = 0; i < children.length; i++) {
        if (getChildrensChildren) {
            relevantChildren += getCount(children[i], true);
        }
        relevantChildren++;
    }
    return relevantChildren;
}
