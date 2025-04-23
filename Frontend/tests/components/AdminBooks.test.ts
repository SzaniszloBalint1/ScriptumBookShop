// tests/components/Admin/AdminBooks.test.ts
import { mount } from "@vue/test-utils";
import AdminBooks from "@/Admin/AdminBooks.vue";
import { describe, it, expect, vi, beforeEach } from "vitest";

describe("AdminBooks.vue", () => {
  const mockBooks = [
    {
      id: 1,
      title: "Test Book 1",
      author: "Author 1",
      isbn: "1234567890123",
      publish_date: "2022-01-01",
      price: 1000,
      cover_image: "test1.jpg"
    },
    {
      id: 2,
      title: "Test Book 2",
      author: "Author 2",
      isbn: "1234567890124",
      publish_date: "2022-01-02",
      price: 2000,
      cover_image: "test2.jpg"
    }
  ];
  
  const mockStore = {
    getters: {
      "book/books": mockBooks
    },
    dispatch: vi.fn()
  };
  
  beforeEach(() => {
    vi.clearAllMocks();
  });
  
  it("renders the admin books list", () => {
    const wrapper = mount(AdminBooks, {
      global: {
        mocks: {
          $store: mockStore
        },
        stubs: ["router-link", "router-view"]
      }
    });
    
    expect(wrapper.find("h1").text()).toBe("Admin könyvlista");
    const tableRows = wrapper.findAll("tbody tr");
    expect(tableRows.length).toBe(2);
    expect(tableRows[0].findAll("td")[1].text()).toBe("Test Book 1");
    expect(tableRows[0].findAll("td")[2].text()).toBe("Author 1");
    expect(tableRows[0].findAll("td")[5].text()).toBe("1000 Ft");
  });
  
  it("calls getData on creation", () => {
    mount(AdminBooks, {
      global: {
        mocks: {
          $store: mockStore
        },
        stubs: ["router-link", "router-view"]
      }
    });
    
    expect(mockStore.dispatch).toHaveBeenCalledWith("book/getData");
  });
  
  it("confirms before deleting a book", async () => {
    const originalConfirm = window.confirm;
    window.confirm = vi.fn(() => true);
    
    const wrapper = mount(AdminBooks, {
      global: {
        mocks: {
          $store: mockStore
        },
        stubs: ["router-link", "router-view"]
      }
    });
    
    await wrapper.find("button.btn-danger").trigger("click");
    
    expect(window.confirm).toHaveBeenCalledWith("Biztosan törölni szeretnéd?");
    expect(mockStore.dispatch).toHaveBeenCalledWith("book/deleteBook", 1);
    window.confirm = originalConfirm;
  });
  
  it("doesn't delete if not confirmed", async () => {
    const originalConfirm = window.confirm;
    window.confirm = vi.fn(() => false);
    
    const wrapper = mount(AdminBooks, {
      global: {
        mocks: {
          $store: mockStore
        },
        stubs: ["router-link", "router-view"]
      }
    });
    
    await wrapper.find("button.btn-danger").trigger("click");
    
    expect(window.confirm).toHaveBeenCalledWith("Biztosan törölni szeretnéd?");
    expect(mockStore.dispatch).not.toHaveBeenCalledWith("book/deleteBook", 1);
    window.confirm = originalConfirm;
  });
});
