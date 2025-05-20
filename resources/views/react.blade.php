<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Stylish</title>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"
    rel="stylesheet"
  />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet"
  />
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
  <div class="container mx-auto px-4 py-8 max-w-3xl">
    
    <!-- Sales Performance Section -->
    <div class="mb-10 bg-white p-6 rounded-xl shadow-lg">
      <h2 class="text-3xl font-semibold mb-6 text-gray-900 border-b border-gray-300 pb-2">
        Sales Performance
      </h2>

      <div class="flex items-center mb-4">
        <div class="w-5 h-5 bg-teal-500 rounded mr-3"></div>
        <span class="text-gray-700 font-medium">Sales in 2025</span>
      </div>

      <div class="relative h-64">
        <!-- SVG Chart -->
        <svg viewBox="0 0 400 200" class="w-full h-full">
          <!-- Grid Lines -->
          <line x1="0" y1="0" x2="0" y2="180" stroke="#e5e7eb" stroke-width="1" />
          <line x1="0" y1="180" x2="400" y2="180" stroke="#e5e7eb" stroke-width="1" />
          <line x1="0" y1="144" x2="400" y2="144" stroke="#e5e7eb" stroke-width="0.5" />
          <line x1="0" y1="108" x2="400" y2="108" stroke="#e5e7eb" stroke-width="0.5" />
          <line x1="0" y1="72" x2="400" y2="72" stroke="#e5e7eb" stroke-width="0.5" />
          <line x1="0" y1="36" x2="400" y2="36" stroke="#e5e7eb" stroke-width="0.5" />

          <!-- Line Chart -->
          <polyline
            points="40,126 120,72 200,108 280,54 360,18"
            fill="none"
            stroke="#0f766e"
            stroke-width="4"
            stroke-linejoin="round"
            stroke-linecap="round"
          />

          <!-- Data Points -->
          <circle cx="40" cy="126" r="5" fill="#0f766e" stroke="#000" stroke-width="1" />
          <circle cx="120" cy="72" r="5" fill="#0f766e" stroke="#000" stroke-width="1" />
          <circle cx="200" cy="108" r="5" fill="#0f766e" stroke="#000" stroke-width="1" />
          <circle cx="280" cy="54" r="5" fill="#0f766e" stroke="#000" stroke-width="1" />
          <circle cx="360" cy="18" r="5" fill="#0f766e" stroke="#000" stroke-width="1" />

          <!-- X-Axis Labels -->
          <text x="40" y="200" text-anchor="middle" font-size="14" fill="#374151" font-weight="600">Jan</text>
          <text x="120" y="200" text-anchor="middle" font-size="14" fill="#374151" font-weight="600">Feb</text>
          <text x="200" y="200" text-anchor="middle" font-size="14" fill="#374151" font-weight="600">Mar</text>
          <text x="280" y="200" text-anchor="middle" font-size="14" fill="#374151" font-weight="600">Apr</text>
          <text x="360" y="200" text-anchor="middle" font-size="14" fill="#374151" font-weight="600">May</text>
        </svg>
      </div>
    </div>

    <!-- Counter Section -->
    <div class="bg-gray-900 text-white p-6 rounded-xl shadow-lg mb-10">
      <h2 class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2">Counter</h2>

      <div class="text-5xl font-extrabold mb-6 text-center tracking-wider" id="counter-value">0</div>

      <div class="flex justify-center space-x-4">
        <button
          id="decrement"
          class="w-14 h-14 flex items-center justify-center rounded-md bg-gray-800 hover:bg-black transition focus:outline-none focus:ring-2 focus:ring-teal-400"
          aria-label="Decrement"
        >
          <i class="fas fa-minus text-teal-400 text-2xl"></i>
        </button>
        <button
          id="reset"
          class="w-20 h-14 rounded-md bg-gray-800 hover:bg-black transition text-teal-400 font-semibold"
        >
          Reset
        </button>
        <button
          id="increment"
          class="w-14 h-14 flex items-center justify-center rounded-md bg-gray-800 hover:bg-black transition focus:outline-none focus:ring-2 focus:ring-teal-400"
          aria-label="Increment"
        >
          <i class="fas fa-plus text-teal-400 text-2xl"></i>
        </button>
      </div>
    </div>

    <!-- Form Section -->
    <div class="bg-black bg-opacity-80 p-6 rounded-xl shadow-lg text-white">
      <h2 class="text-2xl font-semibold mb-5 border-b border-gray-700 pb-2">Submit Name</h2>

      <form id="name-form" class="flex space-x-3">
        <input
          type="text"
          id="name"
          placeholder="Enter your name"
          class="flex-grow px-4 py-2 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-teal-400"
          required
        />
        <button
          type="submit"
          class="px-6 py-2 rounded-md bg-teal-500 hover:bg-teal-600 transition font-semibold text-white"
        >
          Submit
        </button>
      </form>
    </div>
  </div>

  <script>
    // Counter functionality
    let counter = 0;
    const counterValue = document.getElementById("counter-value");
    const incrementBtn = document.getElementById("increment");
    const decrementBtn = document.getElementById("decrement");
    const resetBtn = document.getElementById("reset");

    incrementBtn.addEventListener("click", () => {
      counter++;
      counterValue.textContent = counter;
    });

    decrementBtn.addEventListener("click", () => {
      if (counter > 0) {
        counter--;
        counterValue.textContent = counter;
      }
    });

    resetBtn.addEventListener("click", () => {
      counter = 0;
      counterValue.textContent = counter;
    });

    // Form submission
    const form = document.getElementById("name-form");
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const nameInput = document.getElementById("name");
      if (nameInput.value.trim()) {
        alert(`Name submitted: ${nameInput.value.trim()}`);
        nameInput.value = "";
      }
    });
  </script>
</body>
</html>
