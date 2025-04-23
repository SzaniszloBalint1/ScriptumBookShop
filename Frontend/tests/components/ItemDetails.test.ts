import { mount } from "@vue/test-utils";
import { describe, it, expect, vi, beforeEach } from "vitest";
import ItemDetails from "@/components/Books/ItemDetails.vue";


vi.mock("../../layout/ReturnButton.vue", () => ({
  default: {
    name: "ReturnButton",
    template: '<button class="return-button"><slot></slot></button>',
    emits: ['step-back']
  }
}));

vi.mock("../Cart/CartButton.vue", () => ({
  default: {
    name: "CartButton",
    template: '<button class="cart-button"><slot></slot></button>'
  }
}));
const mockBook = {
  id: 1,
  title: "A tesztelés művészete",
  author: "Test Author",
  describe: "Ez egy teszt könyv leírása",
  price: 3500,
  cover_image: "/images/test-book.jpg"
};

describe("ItemDetails.vue", () => {
  const mockStore = {
    getters: {
      "book/bookId": mockBook
    },
    dispatch: vi.fn(),
    commit: vi.fn()
  };

  const mockRouter = {
    push: vi.fn()
  };

  const mockRoute = {
    params: {
      id: "1"
    }
  };
  let wrapper;

  beforeEach(() => {
    vi.clearAllMocks();
    wrapper = mount(ItemDetails, {
      global: {
        mocks: {
          $store: mockStore,
          $router: mockRouter,
          $route: mockRoute
        },
        stubs: {
          "Rating": true,
          "Comment": true,
          "AuthorOtherBooks": true,
          "ReturnButton": true,
          "CartButton": true
        }
      }
    });
  });

  it("betölti a könyv adatait a létrehozáskor", () => {
    expect(mockStore.dispatch).toHaveBeenCalledWith("book/getDataId", "1");
  });

  it("megjeleníti a könyv címét", () => {
    expect(wrapper.find(".book-title").text()).toBe("A tesztelés művészete");
  });

  it("megjeleníti a könyv szerzőjét", () => {
    expect(wrapper.find(".book-author").text()).toBe("Test Author");
  });

  it("megjeleníti a könyv leírását", () => {
    expect(wrapper.find(".book-description").text()).toBe("Ez egy teszt könyv leírása");
  });

  it("megjeleníti a könyv árát", () => {
    expect(wrapper.find(".book-price-container h3").text()).toBe("3500 Ft");
  });

  it("megjeleníti a könyv borítóképét", () => {
    const img = wrapper.find(".book-image");
    expect(img.attributes("src")).toBe("/images/test-book.jpg");
    expect(img.attributes("alt")).toBe("book cover");
  });

  it("visszanavigál a főoldalra a vissza gomb megnyomásakor", async () => {
    await wrapper.find(".back-button").findComponent({ name: "ReturnButton" }).vm.$emit("step-back");
    expect(mockRouter.push).toHaveBeenCalledWith("/home");
  });

  it("hozzáadja a könyvet a kosárhoz a kosár gomb megnyomásakor", async () => {
    await wrapper.find(".cart-button").trigger("click");
  
    expect(mockStore.commit).toHaveBeenCalledWith("cart/addItemToCart", {
      id: mockBook.id,
      name: mockBook.title,
      price: mockBook.price,
      img: mockBook.cover_image
    });
  });

  it("átadja a megfelelő props-okat a Rating komponensnek", () => {
    const ratingComponent = wrapper.findComponent({ name: "Rating" });
    expect(ratingComponent.props("bookId")).toBe(1);
  });

  it("átadja a megfelelő props-okat a Comment komponensnek", () => {
    const commentComponent = wrapper.findComponent({ name: "Comment" });
    expect(commentComponent.props("bookId")).toBe(1);
  });

  it("átadja a megfelelő props-okat az AuthorOtherBooks komponensnek", () => {
    const authorComponent = wrapper.findComponent({ name: "AuthorOtherBooks" });
    expect(authorComponent.props("author")).toBe("Test Author");
    expect(authorComponent.props("currentBookId")).toBe(1);
  });

  it("nem jelenít meg tartalmat, ha nincs könyv adat", async () => {
    const emptyStore = {
      getters: {
        "book/bookId": null
      },
      dispatch: vi.fn(),
      commit: vi.fn()
    };

    const emptyWrapper = mount(ItemDetails, {
      global: {
        mocks: {
          $store: emptyStore,
          $router: mockRouter,
          $route: mockRoute
        },
        stubs: {
          "Rating": true,
          "Comment": true,
          "AuthorOtherBooks": true,
          "ReturnButton": true,
          "CartButton": true
        }
      }
    });

    expect(emptyWrapper.find(".book-section").exists()).toBe(false);
    expect(emptyWrapper.find(".comment-section").exists()).toBe(false);
  });
});